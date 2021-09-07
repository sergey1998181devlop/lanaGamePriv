<?php
function customPostVal($name,$post = array()){
    if(!empty(old($name))){return old($name);}
    
    if(!empty($post)){
       return $post->$name;}
       if($name=="type" && isset($_GET['type'])){
        return $_GET['type'];
     }
       return '';
}
$action=$page == 'addPost' ? url('post/create') : url('post/update').'/'.$post->id;

?>

<section class="write-article main-section">
			<div class="container-fluid">
				<div class="frame">
					<div class="row justify-content-center">
						<div class="col-12">
                        <form action="{{$action}}" id="postForm" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }} 
                            
							<div class="write-article-section">
							
                               
								<div class="write-article-content">
                                  <label for="name_post">Заголовок</label>
                                    <input type="text" id="name_post" value="{{customPostVal('name',$post)}}" name="name" placeholder="Заголовок">
                                </div>
                                <div class="write-article-editor image-section" style="width: 50%;float: left;">
                                    <div id="result-img" class="text-center">
                                   @if(isset($post->image))  
                                        <img class="img-responsive imgLink" style="max-width:100%" alt="Image three" src="{{url('../storage/app/public/posts').'/'.$post->image}}">
                                   @endif
                                    </div>
                                    <label class="fileContainer notsel">
                                        <span for="file-upload" class="custom-file-upload upload-span">
                                        <i class="fas fa-cloud-upload-alt"></i> 
                                        @if(isset($post->image))  
                                          <span class="up">изменить</span>
                                          @endif
                                          <span class="chng">изменить</span>
                                          <span class="title">Главную картинку</span> 
                                        </span>
                                        <input type="file" onchange="readURL(this)"  accept="image/jpg, image/jpeg,image/png"  name="img" id="addpost-imgs" style="display: none;"  />
                                    </label>
                                </div>
                            
                                <div class="clear"></div>
                                        <div style="margin:15px;"></div>

                                <div class="write-article-editor">
                                        <textarea name="about" id="editor"  style="min-height:200px;">{{customPostVal('about',$post)}}</textarea>
                                        <div style="margin:15px;"></div>
                                    </div>
                                    <div class="write-article-header">
                                        <button type="submit"  class="publish">Опубликовать</button>
                                    </div>
                            </div>
                        </form>
						</div>
					</div>
				</div>
			</div>
        </section>
        
        @section('scripts')
<script src="{{url('admin/vendor/ckeditor/ckeditor.js')}}"></script>
<script>
function readURL(input){var i=1;var names=new Array();while(i>=0){
    if(input.files&&input.files[i]){
      names[i]=input.files[i].name;
      var reader=new FileReader();
      reader.onload=function(e,file){name=e.target.fileName;
        $('.image-section #result-img').empty();
            $('.image-section #result-img').append('<img class="img-responsive imgLink" style="max-width:100%" alt="Image three" src="'+e.target.result+'">')};
          reader.fileName=input.files[i].name;
          reader.readAsDataURL(input.files[i])
          }
    i--};
    $('.image-section .fileContainer').removeClass('notsel');
};


CKEDITOR.addCss('figure[class*=easyimage-gradient]::before { content: ""; position: absolute; top: 0; bottom: 0; left: 0; right: 0; }' +
'figure[class*=easyimage-gradient] figcaption { position: relative; z-index: 2; }' +
'.easyimage-gradient-1::before { background-image: linear-gradient( 135deg, rgba( 115, 110, 254, 0 ) 0%, rgba( 66, 174, 234, .72 ) 100% ); }' +
'.easyimage-gradient-2::before { background-image: linear-gradient( 135deg, rgba( 115, 110, 254, 0 ) 0%, rgba( 228, 66, 234, .72 ) 100% ); }');

CKEDITOR.replace('editor', {
  language: 'ru',
removePlugins: 'image',
extraPlugins : 'colorbutton,videoembed,easyimage',
removeDialogTabs: 'link:advanced',
height: 330,
cloudServices_uploadUrl: 'saveImage',
cloudServices_tokenUrl: 'https://33333.cke-cs.com/token/dev/ijrDsqFix838Gh3wGO3F77FSW94BwcLXprJ4APSp3XQ26xsUHTi0jcb1hoBt',
easyimage_styles: {
  gradient1: {
    group: 'easyimage-gradients',
    attributes: {
      'class': 'easyimage-gradient-1'
    },
    label: 'Blue Gradient',
    icon: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/gradient1.png',
    iconHiDpi: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/hidpi/gradient1.png'
  },
  gradient2: {
    group: 'easyimage-gradients',
    attributes: {
      'class': 'easyimage-gradient-2'
    },
    label: 'Pink Gradient',
    icon: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/gradient2.png',
    iconHiDpi: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/hidpi/gradient2.png'
  },
  noGradient: {
    group: 'easyimage-gradients',
    attributes: {
      'class': 'easyimage-no-gradient'
    },
    label: 'No Gradient',
    icon: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/nogradient.png',
    iconHiDpi: 'https://ckeditor.com/docs/ckeditor4/4.11.4/examples/assets/easyimage/icons/hidpi/nogradient.png'
  }
},
easyimage_toolbar: [
  'EasyImageFull',
  'EasyImageSide',
  'EasyImageGradient1',
  'EasyImageGradient2',
  'EasyImageNoGradient',
  'EasyImageAlt'
]
});


</script>
@endsection