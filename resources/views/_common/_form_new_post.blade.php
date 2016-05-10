@if(!isset($success))
    @if(isset($user_id))
        <form id="newpost-form" name="NewPost" method="post" action="/newpost"  enctype="multipart/form-data">
            <div class="content-class">
                <p>Title:</p>
                <input type="text" name="title" />
            </div>
            <div class="content-class">
                <p>Content:</p>
                <textarea form ="newpost-form" name="content" class="newpost-area" cols="35" wrap="soft" maxlength="3000"></textarea>
                <br />
            </div>
            <div class="content-class">

                <input type="file" name="poster"/>
            </div>
            <input type="submit" class="btn btn-success pull-right add-post"/>
        </form>
    @else
        <h1 class="error">You don't have permission</h1>
    @endif
@else
    <h1 class="error">Success</h1>
@endif
