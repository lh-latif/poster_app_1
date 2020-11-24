<template>
  <div v-if="!$store.state.post.post.loading" class="my-3 post-container">
    <div class="post-section">
      <div class="post-title">
        <h1>{{post.data.title}}</h1>
      </div>

      <div v-html="content" class="content"></div>
    </div>

    <CommentSection />
  </div>
</template>

<script>
import CommentSection from "./PostView/CommentSection.vue";
import MarkdownIt from "markdown-it";
const markdown = new MarkdownIt({html: true, breaks: false});

export default {
  components: {
    "CommentSection": CommentSection
  },
  // data: function() {
  //   return {
  //     post: {
  //       loading: true,
  //       data: {
  //         title: "",
  //         content: ""
  //       },
  //     }
  //   };
  // },
  computed: {
    // title: function()
    // {
    //   return this.post.data.title;
    // },
    // content: function()
    // {
    //   return this.post.data.content;
    // },
    post: function()
    {
      return this.$store.state.post.post
    },
    content: function()
    {
      return markdown.render(this.post.data.content);
    }
  },
  mounted: function()
  {
    const post_id = this.$route.params.id;
    this.$store.dispatch({type: "post/initState", data: post_id});
  }
}
</script>

<style>
.post-container {
  max-width: 720px;
  margin: auto;
}

.post-section {
  margin-top: 100px;
  margin-bottom: 100px;
}

.post-title {
  margin-bottom: 40px;
}

.content p {
  font-size: 14pt
}
</style>
