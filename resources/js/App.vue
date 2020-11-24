<template>
  <div>
    <div class="top-bar">
      <div class="title-box">
        <span class="title-text">Simple Blog</span>
      </div>

      <div class="topbar-right-content">
        <span v-for="item in topMenu">
          <router-link :to="item.link" >
            {{item.text}}
          </router-link>
        </span>
      </div>

    </div>
    <div class="container">
      <router-view/>
    </div>
  </div>
</template>

<script>
function topLinks(hasLogin) {
  return [
    {link: "/", text: "Posts", show: true},
    {link: "/login", text: "Login", show: !hasLogin},
    {link: "/register", text: "Register", show: !hasLogin},
    {link: "/account", text: "Akun", show: hasLogin}
  ];
}

export default {
  computed: {
    hasLogin: function() {
      return this.$store.state.user.hasLogin;
    },
    topMenu: function() {
      return topLinks(this.hasLogin).filter((item) => item.show);
    }
  },
  methods: {

  }
}
</script>
