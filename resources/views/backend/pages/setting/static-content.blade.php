@extends('backend.include.app')
@section('title', 'Settings | '.Helper::getSettings('application_name') ?? 'Kefas' )
@section('content')
    <div class="container-fluid px-4">
        <h4 class="mt-2">Settings</h4>

        <div class="card my-2">
            <div class="card-header">
                <div class="row ">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="d-flex align-items-center"><h5 class="m-0">Static Content</h5></div>
                    </div>
                </div>
            </div>

            <div class="card-body pb-0">
                <form action="{{ route('admin.setting.update') }}" id="settingForm" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Site Hero Banner Images :</label>
                        <div class="col-sm-3">
                            <input type="file" class="form-control" onchange="previewFile('settingForm #hero_banner_image', 'settingForm .hero_banner_image')" name="hero_banner_image" id="hero_banner_image">

                            <img src="{{ Helper::getSettings('hero_banner_image') ? asset('uploads/settings/'.Helper::getSettings('hero_banner_image')) : asset('assets/img/no-img.jpg')}}" height="80px" width="100px" class="hero_banner_image mt-1 border" alt="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Hero Section Heading :</label>
                        <div class="col-sm-9">
                            <textarea name="hero_section_heading" id="" class="tinymceText form-control" cols="30" rows="20">{!! Helper::getSettings('hero_section_heading') !!}</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Site Hero Carousel Image:</label>
                        <div class="col-sm-3">
                            <label for="" class="col-sm-3 col-form-label">Image-1:</label>
                            <input type="file" class="form-control" onchange="previewFile('settingForm #hero_image_1', 'settingForm .hero_image_1_image')" name="hero_image_1" id="hero_image_1">

                            <img src="{{ Helper::getSettings('hero_image_1') ? asset('uploads/settings/'.Helper::getSettings('hero_image_1')) : asset('assets/img/no-img.jpg')}}" height="80px" width="100px" class="hero_image_1_image mt-1 border" alt="">
                        </div>
                        <div class="col-sm-3">
                            <label for="" class="col-sm-3 col-form-label">Image-2</label>
                            <input type="file" class="form-control" onchange="previewFile('settingForm #hero_image_2', 'settingForm .hero_image_2')" name="hero_image_2" id="hero_image_2">

                            <img src="{{ Helper::getSettings('hero_image_2') ? asset('uploads/settings/'.Helper::getSettings('hero_image_2')) : asset('assets/img/no-img.jpg')}}" height="80px" width="100px" class="hero_image_2 mt-1 border" alt="">
                        </div>
                        <div class="col-sm-3">
                            <label for="" class="col-sm-3 col-form-label">Image-3</label>
                            <input type="file" class="form-control" onchange="previewFile('settingForm #hero_image_3', 'settingForm .hero_image_3')" name="hero_image_3" id="hero_image_3">
                            
                            <img src="{{ Helper::getSettings('hero_image_3') ? asset('uploads/settings/'.Helper::getSettings('hero_image_3')) : asset('assets/img/no-img.jpg')}}" height="80px" width="100px" class="hero_image_3_image mt-1 border" alt="">
                        </div>
                    </div>
                    

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Benefits of Member:</label>
                        <div class="col-sm-9">
                            <textarea name="about_us" id="" class="tinymceText form-control" cols="30" rows="20">{!! Helper::getSettings('about_us') !!}</textarea>
                        </div>
                    </div>

                    {{-- mission & vision --}}
                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">Mission & Vision</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="" class="col-form-label">Mission:</label>
                                    <textarea name="mission" id="" class="tinymceText form-control" cols="30" rows="10">{!! Helper::getSettings('mission') !!}</textarea>
                                </div>
                                <div class="col-sm-6">
                                    <label for="" class="col-form-label">Vision:</label>
                                    <textarea name="vision" id="" class="tinymceText form-control" cols="30" rows="10">{!! Helper::getSettings('vision') !!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- mission & vision --}}

                    {{-- CTA Banner --}}

                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">CTA Banner Image :</label>
                        <div class="col-sm-3">
                            <input type="file" class="form-control" onchange="previewFile('settingForm #cta_image', 'settingForm .cta_image')" name="cta_image" id="cta_image">

                            <img src="{{ Helper::getSettings('cta_image') ? asset('uploads/settings/'.Helper::getSettings('cta_image')) : asset('assets/img/no-img.jpg')}}" height="80px" width="100px" class="cta_image mt-1 border" alt="">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">CTA Banner Heading :</label>
                        <div class="col-sm-9">
                            <textarea name="cta_header" id="" class="tinymceText form-control" cols="30" rows="20">{!! Helper::getSettings('cta_header') !!}</textarea>
                        </div>
                    </div>

                    {{-- CTA Banner --}}


                    {{-- important --}}

                    {{-- <div class="form-group row">
                        <label for="" class="col-sm-3 col-form-label">About Page Images:</label>
                        <div class="col-sm-3">
                            <input type="file" class="form-control" onchange="previewFile('settingForm #about_image_1', 'settingForm .about_image_1_image')" name="about_image_1" id="about_image_1">
                            <img src="{{ Helper::getSettings('about_image_1') ? asset('uploads/settings/'.Helper::getSettings('about_image_1')) : asset('assets/img/no-img.jpg')}}" height="80px" width="100px" class="about_image_1_image mt-1 border" alt="">
                        </div>
                        <div class="col-sm-3">
                            <input type="file" class="form-control" onchange="previewFile('settingForm #about_image_2', 'settingForm .about_image_2_image')" name="about_image_2" id="about_image_2">
                            <img src="{{ Helper::getSettings('about_image_2') ? asset('uploads/settings/'.Helper::getSettings('about_image_2')) : asset('assets/img/no-img.jpg')}}" height="80px" width="100px" class="about_image_2_image mt-1 border" alt="">
                        </div>
                        <div class="col-sm-3">
                            <input type="file" class="form-control" onchange="previewFile('settingForm #about_image_3', 'settingForm .about_image_3_image')" name="about_image_3" id="about_image_3">
                            <img src="{{ Helper::getSettings('about_image_3') ? asset('uploads/settings/'.Helper::getSettings('about_image_3')) : asset('assets/img/no-img.jpg')}}" height="80px" width="100px" class="about_image_3_image mt-1 border" alt="">
                        </div>
                    </div> --}}

                    {{-- important --}}

                    <div class="form-group text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('footer')
        <script type="text/javascript">

        </script>
    @endpush
@endsection
