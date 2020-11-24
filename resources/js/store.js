// import postUpdater from "./post_updater.js";
import postModule from "./store/modules/post.js";

export default function storeSetup(Vuex) {
  return new Vuex.Store({
    state: {
      user: {
        hasLogin: false,
        data: null
      },
      model: null
    },
    mutations: {
      userHasLogged: function(state, payload)
        {
          state.user = {
            hasLogin: true,
            data: payload.data
          }
        },
    },
    modules: {
      post: postModule
    }
  });
}
