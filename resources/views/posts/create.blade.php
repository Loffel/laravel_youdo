@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    @include('includes/dashboard_sidebar')
    
    <div class="dashboard-content-container" data-simplebar>
        <div class="dashboard-content-inner" >
            
            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>Создать задание</h3>

                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Главная</a></li>
                        <li><a href="#">Панель управления</a></li>
                        <li>Добавить пост</li>
                    </ul>
                </nav>
            </div>
    
            <!-- Row -->
            <div class="row">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Dashboard Box -->
                    <div class="col-xl-12">
                        <div class="dashboard-box margin-top-0">

                            <!-- Headline -->
                            <div class="headline">
                                <h3><i class="icon-feather-folder-plus"></i> Форма создания поста</h3>
                            </div>

                            <div class="content with-padding padding-bottom-10">
                                <div class="row">

                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Заголовок</h5>
                                            <input type="text" class="with-border" name="title" placeholder="Введите заголовок поста..." required>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="submit-field">
                                            <h5>Контент</h5>
                                            <textarea cols="30" rows="5" name="content" class="with-border"></textarea>
                                            <div class="uploadButton margin-top-30">
                                                <input class="uploadButton-input" type="file" accept="image/*" name="cover" id="upload" required>
                                                <label class="uploadButton-button ripple-effect" for="upload">Загрузить обложку</label>
                                                <span class="uploadButton-file-name">Данная картинка будет использована в качестве обложки поста.</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12">
                        <button type="submit" class="button ripple-effect big margin-top-30"><i class="icon-feather-plus"></i> Создать</button>
                    </div>
                </form>
            </div>
            <!-- Row / End -->

            @include('includes/dashboard_footer')

        </div>
    </div>
    <!-- Dashboard Content / End -->

</div>
@endsection