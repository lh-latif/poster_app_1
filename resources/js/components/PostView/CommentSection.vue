<template>
  <div>
    <h3>Komentar</h3>
    <div>
      <CommentForm />
    </div>
  </div>
</template>

<script>
import CommentForm from "./CommentForm.vue";

export default {
  components: {
    "CommentForm": CommentForm
  }
}
</script>
