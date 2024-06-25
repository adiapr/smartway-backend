<div class="page-header mt-5 border-bottom pb-2">
    <h4 class="page-title">{{ @$title }}</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="#">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">{{ @$sub }}</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">{{ @$title }}</a>
        </li>
    </ul>
    @section('title')
        {{ @$title }}
    @endsection
</div>