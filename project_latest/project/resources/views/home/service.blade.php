<div class="services_section layout_padding">
         <div class="container">
            <h1 class="services_taital">Blogs </h1>
            <div class="services_section_2">
               <div class="row">
               @foreach($post as $post)
                  <div class="col-md-4">
                     <h1><div>{{ $post->title }}</div>  </h1>                  
                     <div><img class="services_img" src="postimage/{{ $post->image }}"/></div>
                     <div class="btn_main"><a href="{{ url('detail_post/'.$post->id)}}">Detail</a></div>
                  </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>