<?php

namespace App\Http\Controllers;

require base_path() . '/vendor/autoload.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Comment;

class GenerateSummeryController extends Controller
{
    function generateSummery(Request $lessonDetails) {
        return redirect()->back(); 
        set_time_limit(0);
        $token = '02jT906QhCc3y2EiJWB48MGV4JAt5U1et15PUfl1cdIqLwuXFU_sq1YhpfQU0Ts58YOZ3dMRz2uL65jo-U6wxOa7RfXoo';
        $file = base_path() . "/" . $lessonDetails->lessonLink;

        // create client
        $client = new Client([
            'base_uri' => 'https://api.rev.ai/speechtotext/v1/',
            'headers' => ['Authorization' => "Bearer $token"]
        ]);

        // send POST request and get response body
        $response = $client->request(
            'POST',
            'jobs',
            ['multipart' => [['name' => 'media','contents' => fopen($file, 'r')]]]
        )
        ->getBody()
        ->getContents();

        // decode response JSON and print
        if (json_decode($response)->status == 'in_progress') {
            $jobId = json_decode($response)->id;
            // $this->checkStatusForJob(json_decode($response)->id);

            while(true) {
                // create client
                $client = new Client([
                'base_uri' => 'https://api.rev.ai/speechtotext/v1/',
                'headers' => ['Authorization' => "Bearer $token"]
                ]);
        
                // send GET request and get response body
                $response = $client->request(
                    'GET',
                    "jobs/$jobId"
                )
                ->getBody()
                ->getContents();
    
                if (json_decode($response)->status == 'transcribed') {
                    break;
                } else{
                    continue;
                }
            }
    
            $plain_text = '';
            $token = '02jT906QhCc3y2EiJWB48MGV4JAt5U1et15PUfl1cdIqLwuXFU_sq1YhpfQU0Ts58YOZ3dMRz2uL65jo-U6wxOa7RfXoo';

            // create client
            $client = new Client([
                'base_uri' => 'https://api.rev.ai/speechtotext/v1/',
                'headers' => ['Authorization' => "Bearer $token"]
            ]);

            // send GET request and get response body
            $response = $client->request(
                'GET',
                "jobs/$jobId/transcript",
                ['headers' => ['Accept' => 'application/vnd.rev.transcript.v1.0+json']]
            )
            ->getBody()
            ->getContents();

            // decode response JSON and print
            $hugeArray = json_decode($response, true);
            //dd(count($hugeArray["monologues"]));
            for ($index = 0; $index < count($hugeArray["monologues"]); ++$index) {
                foreach ($hugeArray["monologues"][$index]["elements"] as $key) {
                    $plain_text = $plain_text . $key["value"];
                }
            }
            
            Session()->flash("decoded_summery", $plain_text);

            return redirect()->back();
        } else {
            dd('nn');
        }
    }
}
