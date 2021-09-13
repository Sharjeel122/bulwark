@extends('layouts.app')

@section('style')

@endsection

@section('content')
<div class="container">
     <div class="dashboard-right-scroll-contetn container-fluid">
         @if(session()->has('alert-success'))
            <div class="alert alert-success">
                {{ session()->get('alert-success') }}
            </div>
        @endif
    <div class="row">
      <div class="col-lg-6 col-md-6  col-sm-6 col-8 my-auto">
          <div class="dashboard-right-title-tag">
              <h6 class="mb-0">Support Ticket</h6>

              <p class="mb-0"><strong>Subject : </strong> {{ $ticker_info->subject }}</p>
              <p class="mb-0"><strong>Priority : </strong> {{ $ticker_info->priority }}</p>
              <p class="mb-0"><strong>Status : </strong>
              @if($ticker_info->status == 1)
                Open
              @else
                Close
              @endif
              </p>
           </div>
      </div>
       <div class="col-lg-6 col-md-6 col-sm-6 col-4 text-right">
            <!-- <button type="file"> Upload</button>   -->
            @if($ticker_info->status == 1)
             <a href="{{ route('employee.close.ticker', $ticker_info->id) }}"><label class="choose-file"><i class="fa fa-eye-slash"></i> Close Ticket </label></a>
            @else
            <a href="{{ route('employee.open.ticker', $ticker_info->id) }}"><label class="choose-file"><i class="fa fa-eye"></i> Reopen Ticket </label></a>
             @endif
        </div>
   </div>
         <hr>
               <div class="dasboard-right-main-contetent-area">


 <form  class="row py-5" action="{{ route('employee.reply.ticker' ) }}" method="post">
            @csrf
            <input type="hidden" name="ticker_id" value="{{ $ticker_info->id }}">

             @if($ticker_info->status == 1)
            <div class="col-md-12 col-lg-12 col-sm-12 col-12 pb-3">
                <label>Message</label>

                <textarea id="full-featured" name="message"></textarea>
                 @if ($errors->has('message'))
                        <span role="alert">
              <strong class="text-danger">{{ $errors->first('message') }}</strong>
         </span>
                    @endif
            </div>

            <div class="col-md-12 col-lg-12 col-sm-12 col-12 pt-3">
            <button type="submit" class="btn btn-default-blue w-2">Reply</button>
        </div>
        @else

         <div class="col-md-12 col-lg-12 col-sm-12 col-12 pb-3">
                <h4>Click open button to repon this Ticket</h4>
          @endif
        </form>


              @foreach($tickers as $ticker)

              @if($ticker->user_id)
              @php
                $user = \App\Models\User::findOrFail($ticker->user_id);
              @endphp
              <div class="reply-user">
                  <STRONG>{{ $user->name }} :</STRONG> {!! $ticker->message !!}
              @else
                @php
                $user = \App\Models\User::findOrFail($ticker->employee_id);
              @endphp
              <div class="reply-employee">
                  <STRONG>{{ $user->name }}(Support Team Reply) :</STRONG> {!! $ticker->message !!}

               @endif
              </div>
              @endforeach
              <hr />

    </div>
</div>
@endsection


@section('script')
<script>
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
  height: 600,
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
@endsection
