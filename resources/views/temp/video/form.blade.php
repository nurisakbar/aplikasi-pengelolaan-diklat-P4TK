<div class="form-group">
    <label for="exampleInputEmail1">Judul</label>
    {!! Form::text('title', null, ['class'=>'form-control','placeholder'=>'Judul Panduan Kerja']) !!}
</div>
@if(isset($video))
  <div class="form-group">
    <label for="exampleInputEmail1">Deskripsi</label>
    {!! Form::textarea('description1', $video->description, ['class'=>'form-control']) !!}
  </div>
@else
  <div class="form-group">
    <label for="exampleInputEmail1">Deskripsi</label>
    {!! Form::textarea('description1', null, ['class'=>'form-control']) !!}
  </div>
@endif
  <button type="submit" class="btn btn-primary">Simpan Panduan Kerja</button>
  <a href="/video" class="btn btn-primary">Kembali</a>


  @push('scripts')
  <script src="https://cdn.ckeditor.com/4.16.2/standard-all/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('description1', {
      extraPlugins: 'embed,autoembed,image2',
      height: 200,

      // Load the default contents.css file plus customizations for this sample.
      contentsCss: [
        'http://cdn.ckeditor.com/4.16.2/full-all/contents.css',
        'https://ckeditor.com/docs/ckeditor4/4.16.2/examples/assets/css/widgetstyles.css'
      ],
      // Setup content provider. See https://ckeditor.com/docs/ckeditor4/latest/features/media_embed
      embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',

      // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
      // resizer (because image size is controlled by widget styles or the image takes maximum
      // 100% of the editor width).
      image2_alignClasses: ['image-align-left', 'image-align-center', 'image-align-right'],
      image2_disableResizer: true,
      removeButtons: 'PasteFromWord'
    });
  </script>
  @endpush