<div style="max-width: 100%;" class="w-100 container d-flex justify-content-center align-items-center pt-4">
    <!--Form container-->
    <div class="mx-auto">
        <div id="messaging" class="messaging d-none p-3 bg-primary text-white">Your Form is currently Processing!</div>
        <form onsubmit="createBanner(event)" id="categoryForm" class="w-100 category-form px-4 py-3" enctype="multipart/form-data">
            @csrf
        <div class="title-header  d-flex justify-content-between align-items-center px-3 py-3">
            <h3 class="px-2 pl-0">Create Banner</h3>
            <a onclick="changeState(`{{ route('view-banner') }}`)" style="cursor:pointer; text-decoration: none;">
            <i
                    class="fa fa-angle-left mr-1"
                    style="color: black; font-weight: bold; font-size: 20px;"
                  ></i>
                  Banners</a>
        </div>
         <div class="row w-100">
            <div class="form-group col-lg-12 col-sm-12 my-4">
                <label for="name">Banner Image</label>
                <input type="file" name="image" required id="banner_image" class="w-100 form-control">
            </div>
         </div>
         <div class="row">
            <button onclick="createBanner(event)" type="submit" class="bg-info border-0 btn-lg btn-flat">Submit</button>
         </div>
        </form>
    </div>
</div>



<style>
    .category-form{
        width: 800px;
        max-width: 100%;
        background-color: white;
        box-shadow: 1px 3px 4px #bbb;
    }

    input[type='text'], textarea ,input[type="file"] {
        border-radius: 10px;
    }

    .error {
        color: red;
        font-size: 10px;
        padding: 8px;
    }

</style>