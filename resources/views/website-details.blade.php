<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Bulwark</title>
    <!-- Bootstrap CSS Files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">

    <!-- Custom Style CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }} ">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>




<!-- dashbaord right  content  -->
<section id="header">
    <div class="dashoard-right-content-frontpages">
        <!-- nvabar for mobile  -->
        <div class="dashoard-navbar-area-frontpages container-fluid bg-success">
            <div class="row">
                <div class="col-6  mt-auto">
                    <div class="mobile-toggle-fixed">

                        <div class="d-none d-lg-block d-sm-block d-md-block">
                            <h3 class="logo-text">Cyber Bulwark</h3>
                        </div>
                        <div class="d-block d-lg-none d-sm-none d-md-none">
                            <h3 class="logo-text">Cyber Bulwark</h3>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-6 mt-auto text-right">
                 <div class="ml-auto">
                   <button class="btn-white">Login</button>
               </div>
                </div> -->
            </div>

        </div>
        <!-- nvabar for mobile end -->

        <!---Page Intro-->
    </div>
</section>

<!-----intro Section-->
<section class="intro-section">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-12 col-12 "></div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
{{--            <div class="welocme-area-main">--}}
{{--                <div class="welcome-text-area text-center">--}}
                    <!-- <h2 class="text-center intro-text">Access Your Files In Just One Click</h2> -->


                    <form method="POST" action="{{ route('customer.update.website.info', $website->id) }}" class="account-form-style-login-2">
                        @csrf
                        @method('PUT')

                        <h4 class="text-center  intro-text-small">Website Details</h4>
                        <div class="form-group">
                            <label class="form-labels" for=""><strong>Add Website Complete Details(*)</strong></label>
                            <textarea  name="website_data" class="form-control" rows="15" placeholder="Add website Complete details like cpanel credentials admin credentials and other important links"></textarea>
                            @if ($errors->has('website_data'))
                                <span role="alert">
              <strong class="text-danger">{{ $errors->first('website_data') }}</strong>
         </span>
                            @endif
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-default-blue w-2">Submit</button>
                        </div>
                    </form>

{{--                </div>--}}
{{--            </div>--}}
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-12 "></div>
    </div>
</section>


<!-- Bootstrap JS Files -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascrip"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('assets/js/custom.js') }}" type="text/javascrip"></script>
<script src="https://cdn.tiny.cloud/1/h5dq8h6fi7v5m8057704lf1w1yysza69njl7fof6ai4b5yrj/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


<script>
    // tinymce.init({
    //   selector: 'textarea#tiny'
    // });
    //    $(document).on('focusin', function(e) {
    //   if ($(e.target).closest(".tox-tinymce, .tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
    //     e.stopImmediatePropagation();
    //   }
    // });

    var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

    tinymce.init({
        selector: 'textarea#full-featured',
        plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        imagetools_cors_hosts: ['picsum.photos'],
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | paste | image code | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
        toolbar_sticky: true,
        autosave_ask_before_unload: true,
        autosave_interval: '30s',
        autosave_prefix: '{path}{query}-{id}-',
        autosave_restore_when_empty: false,
        autosave_retention: '2m',
        image_advtab: true,
        // images_upload_url: 'postAcceptor.php',
        paste_data_images: true,
        link_list: [
            { title: 'My page 1', value: 'https://www.tiny.cloud' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_list: [
            { title: 'My page 1', value: 'https://www.tiny.cloud' },
            { title: 'My page 2', value: 'http://www.moxiecode.com' }
        ],
        image_class_list: [
            { title: 'None', value: '' },
            { title: 'Some class', value: 'class-name' }
        ],
        /* we override default upload handler to simulate successful upload*/
        // images_upload_handler: function (blobInfo, success, failure) {
        //   setTimeout(function () {
        //      // no matter what you upload, we will turn it into TinyMCE logo :)
        //     // success(success);
        //     // success('http://moxiecode.cachefly.net/tinymce/v9/images/logo.png');
        //   }, 2000);
        // },
        importcss_append: true,
        file_picker_callback: function (callback, value, meta) {
            /* Provide file and text for the link dialog */
            if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === 'media') {
                callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
            }
        },
        templates: [
            { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
            { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
            { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
        ],
        template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
        template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
        height: 350,
        image_caption: true,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: 'mceNonEditable',
        toolbar_mode: 'sliding',
        contextmenu: 'link image imagetools table',
        skin: useDarkMode ? 'oxide-dark' : 'oxide',
        content_css: useDarkMode ? 'dark' : 'default',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });

</script>
</body>
</html>
