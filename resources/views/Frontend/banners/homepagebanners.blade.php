@if (isset($page) && $page=="index")
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">
        @foreach ($banners as $key=> $banner)
            <div class="item @if ($key==0) active @endif ">
				<div class="container">
                           <?php $smallpath='frontend/themes/banner_images/'.$banner['image']?>
                                @if (!empty($banner['image']) && file_exists($smallpath))
                                  <a href="">
                                                                      <img style="height: 250px; width: 700px;" src="{{asset('frontend/themes/banner_images/'.$banner['image'])}}" alt="{{$banner['title']}}">

                                  </a>
                                  
                                                                 @else
                               <img style="width: 50px;height: 50px;" src="{{asset('adminlte/adminimages/noimage/noimage.jpg')}}" alt="{{$banner['title']}}">
                            
                                    @endif					
				</div>
			</div>
        @endforeach
			
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>
</div>
@endif