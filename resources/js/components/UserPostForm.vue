<template>
  <div class="pt-5">
    <h1 class="pb-4">Post Baru</h1>
    <form>
        <div class="form-row">
          <div class="form-group col-12">
            <label>Judul</label>
            <input v-model="title" type="text" name="title" class="form-control">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-12">
            <label>Konten</label>
            <textarea v-model="content" class="form-control"></textarea>
          </div>
        </div>

        <button type="button" class="btn btn-primary" @click="submitPost">
          Submit
        </button>
    </form>

  </div>
</template>

<script>

function submitPost(token, data) {
  return new Promise(function(resolve,reject) {
    const req = new XMLHttpRequest();
    req.open("POST", "/api/v1/user/post");
    req.setRequestHeader("Authorization", "Bearer "+token);
    req.setRequestHeader("Content-Type", "application/json");
    req.addEventListener("load", resolve);
    req.addEventListener("error", reject);
    req.send(JSON.stringify(data));
  });
}

export default {
  data: function() {
    return {
      title: "",
      content: ""
    };
  },
  methods: {
    submitPost: async function() {
      const token = this.$store.state.user.data;
      submitPost(token, {
        title: this.title,
        content: this.content
      })
      .then(ev => {
        this.$router.push("/account");
      })
    }
  }

}
</script>
