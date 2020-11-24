<template>
  <div v-if="posts.loading">
    Loading
  </div>
  <div v-else>
    <h1 class="mt-5 mb-4 display-4">List Post</h1>
    <div v-for="post in posts.data" :key="post.id" class="card card-body post-list-card" >
      <div @click="postClicked(post.id)">{{post.title}}</div>
    </div>
  </div>
</template>

<script>
async function get() {
  return new Promise(function(resolve, reject) {
    const req = new XMLHttpRequest();
    req.open("GET", "/api/v1/posts");
    req.responseType = "json";
    req.addEventListener("load",resolve);
    req.addEventListener("error",function(ev) {
      reject(ev);
    });
    req.send();
  });
}


export default {
  data: function() {
    return {
      posts: {
        loading: true,
        result: null,
        data: []
      },

    };
  },
  methods: {
    postClicked: function(id) {
      // window.alert(id);
      this.$router.push("/posts/"+id)
    }
  },
  mounted: function() {
    get()
      .then((ev) => {
        // console.log(evMsg, ev);
        this.posts = {
          loading: false,
          result: "ok",
          data: ev.target.response.data
        }
      })
      .catch(err => {
        console.log(err);
      });
  }
};
</script>
