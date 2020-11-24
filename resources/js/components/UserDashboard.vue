<template>
  <div>
    <div class="my-5">
      <h1>Hallo User</h1>

      <button class="btn btn-primary" @click="toNewPostPage" >Buat Post Baru</button>
    </div>

    <div>

    </div>


  </div>
</template>


<script>

function getUserPosts(token) {
  return new Promise(function(resolve, reject) {
    const req = new XMLHttpRequest();
    req.open("GET", "/api/v1/user/posts");
    req.setRequestHeader("Authorization", "Bearer "+token);
    req.addEventListener("load", resolve);
    req.addEventListener("error", reject);
    req.send();
  });
}

export default {
  data: function() {
    return {
      posts: {
        loading: true,
        status: null,
        data: []
      }
    }
  },
  methods: {
    toNewPostPage: function() {
      this.$router.push("/account/post")
    },
    getUserPosts: async function() {
      const token = this.$store.state.user.data;
      getUserPosts(token)
        .then((ev) => {
          this.posts = {
            loading: false,
            status: "ok",
            data: ev.target.response
          }
        })
    },
  },
  mounted: function() {

  }
}
</script>
