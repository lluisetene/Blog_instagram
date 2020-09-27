<template>
  <div v-if="imgNr > 0" class="card" style="margin-top: 8%;">
  @if(count($user->images) == 0)
  <div class="card" style="margin-top: 8%;">
    <div class="card-header">
      @include('includes.avatar', ['style' => 'float: left; width: 10%;', 'user' => $user, 'other_username' => $user->username])
    </div>

    <div class="card-body">
      card-body
    </div>
  </div>
  @else
  <div class="card" style="margin-top: 8%;">
    <div class="card-header" style="padding-top: 1%; padding-bottom: 1%;">
      @include('includes.avatar', ['style' => 'float:left; width: 10%;', 'user' => $user, 'other_username' => $user->username])
    </div>

    <div class="card-body" style="margin-top: -3%;">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
      @endif
      <div class="row">
        <img src="{{ url('/image/'.$image->image_path) }}" class="detail-img" />
      </div>

      @include('includes.like-comment-share', ['$image' => $image])

      @foreach($image->comments as $comment)
      @include('comment.show_comments', ['comment' => $comment, 'user' => $user])
      @endforeach
      <div class="input-group mb-3" style="margin-top:3%;">
        <input id="comment-to-send" type="text" class="form-control" placeholder="{{__('My comment...')}}" aria-label="User comment" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" id="send-comment-btn" disabled>Share</button>
        </div>
      </div>
    </div>
  </div>
  @endif
</template>

<script>
  export default {
    name: "detail-img",
    data() {
      return {

      }
    }
}
</script>

<style scoped>

</style>