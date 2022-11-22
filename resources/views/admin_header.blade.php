<div class="p-4">
    <h1><a href="/main" class="logo">Eduvance</a></h1>
    <ul class="list-unstyled components mb-5">
        <li>
            <a href="/"><span class="fa fa-home mr-3"></span> Home Page</a>
        </li>
        @if(Session()->get('teacherStatus')['role'] == 'admin' || Session()->get('teacherStatus')['role'] == 'Admin')
            <li class="{{ (request()->is('admin_board')) ? 'active' : '' }}">
            <a href="/admin_board"><span class="fa fa-user mr-3"></span> Registration</a>
            </li>
        @endif
        <li class="{{ (request()->is('add_subject')) ? 'active' : '' }}">
            <a href="/add_subject"><span class="fa fa-book mr-3"></span> Subjects</a>
        </li>
        <li class="{{ (request()->is('add_lesson')) ? 'active' : '' }}">
            <a href="/add_lesson"><span class="fa fa-book mr-3"></span> Lessons</a>
        </li>
        @if(Session()->get('teacherStatus')['role'] == 'admin' || Session()->get('teacherStatus')['role'] == 'Admin')
            <li class="{{ (request()->is('add-contact')) ? 'active' : '' }}">
                <a href="/add-contact"><span class="fa fa-phone-square mr-3"></span> Contact Details</a>
            </li>
        @endif
        <li class="{{ (request()->is('add-documents')) ? 'active' : '' }}">
            <a href="/add-documents"><span class="fa fa-book mr-3"></span> Add Documents</a>
        </li>
        <li>
            <a href="/logout"><span class="fa fa-sign-out mr-3"></span> Sign Out</a>
        </li>

    </ul>

    <div class="footer">
        
    </div>

    </div>
</nav>