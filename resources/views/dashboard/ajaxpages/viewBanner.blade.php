<div class="row">
<div class="col-sm-12">
    <div class="card">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
        <h5>Banners</h5>
        <div class=""><i style="cursor:pointer;" onclick="changeState(`{{ route('create-banner') }}`)" class="fa fa-plus-square h2 text-primary"></i></div>
        </div>
        <div class="card-body">
        <div class="row my-gallery gallery" id="aniimated-thumbnials" itemscope="">
            @forelse($banners as $banner)
            <div class="col-md-3 col-6 mx-2" style="border: 2px solid #6fd6ff; padding: 0;">
                <figure class="img-hover hover-1" itemprop="associatedMedia" itemscope=""><a href="{{ asset('/banner/'.$banner->image) }}" itemprop="contentUrl" data-size="1600x950">
                    <div><img  style="width: 100%; height: auto; max-height: 200px; background-size:contain;" src="{{ asset('/banner/'.$banner->image) }}" itemprop="thumbnail" alt="Image description"></div></a>
                    <figcaption itemprop="caption description">Image caption  1</figcaption>
                </figure>
                <div class="media">
                <i class="fa fa-trash text-danger h2 px-2" style="cursor:pointer;" onclick="deleteBanner({{$banner->id}},event)"></i>

                    <div class="media-body text-end">
                        <label class="switch">
                            @if($banner->display_status == true)
                            <input type="checkbox" checked id="{{$banner->image}}" onclick="updateCheck({{$banner->id}}, event)"><span class="switch-state"></span>
                            @else
                            <input type="checkbox" id="{{$banner->image}}" onclick="updateCheck({{$banner->id}}, event)"><span class="switch-state"></span>
                            @endif
                        </label>
                    </div>
                </div>
            </div>
            @empty
                <div class="p-5">
                    <p>There are currently no Banner Images</p>
                    <button style="cursor:pointer;" onclick="changeState(`{{ route('create-banner') }}`)" class="btn btn-lg btn-primary">Create New Banner</button>
                </div>
            @endforelse
            </div>
            </div>
        </div>
    </div>
</div>