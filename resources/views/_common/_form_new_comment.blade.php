<div class="comment-field">
@if(!isset($success))
    @if(isset($user_id))
        <form id="newcomment-form" name="newComment" method="post" action="/posts/{{$post->id}}">
            <p>Enter commentary here:</p>
            <textarea form ="newcomment-form" name="content" id="new-comment-content" wrap="soft" maxlength="300"></textarea>
            <br />
            <input type="submit" class="btn btn-primary pull-right"/>
        </form>
    @else
        <h1 class="text-danger text-center">You don't have permission for make comments...</h1>
    @endif
@else
    <h1 class="text-success">Success</h1>
@endif
</div>