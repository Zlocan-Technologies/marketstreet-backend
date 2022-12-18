<div style="max-width: 100%;" class="w-100 container d-flex justify-content-center align-items-center pt-4">
    <!--Form container-->
    <div class="mx-auto">
        <div id="messaging" class="messaging d-none p-3 bg-primary text-white">Your Form is currently Processing!</div>
        <form onsubmit="createCategory(event)" id="categoryForm" class="w-100 category-form px-4 py-3" enctype="multipart/form-data">
            @csrf
        <div class="title-header  d-flex justify-content-between align-items-center px-3 py-3">
            <h3 class="px-2 pl-0">Create Category</h3>
            <a onclick="changeState(`{{ route('categories') }}`)" style="cursor:pointer; text-decoration: none;">
            <i
                    class="fa fa-angle-left mr-1"
                    style="color: black; font-weight: bold; font-size: 20px;"
                  ></i>
                  Category List</a>
        </div>
         <div class="row w-100">
            <div class="form-group col-lg-6 col-sm-12 my-4">
                <label for="name">Name <span class="font-danger ml-2">*</span></label>
                <input type="text" required name="category_name" id="category_name" class="form-control">
                <!-- <p id="category_name_error" class="hidden error"></p> -->
            </div>
             <div class="form-group col-lg-6 col-sm-12 my-4">
                <label for="name">Slug</label>
                <input type="text" name="slug" id="category_slug" class="form-control">
            </div>
            <div class="form-group col-lg-6 col-sm-12 my-4">
                <label for="name">Description</label>
                <textarea name="description" id="category_description" cols="30" rows="8" class="form-control">

                </textarea>
            </div>
            <div class="form-group col-lg-6 col-sm-12 my-4">
                <label for="name">Image</label>
                <input type="file" name="image" id="category_image" class="form-control">
            </div>
         </div>
         <div class="row">
            <button onclick="createCategory(event)" type="submit" class="bg-info border-0 btn-lg btn-flat">Submit</button>
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