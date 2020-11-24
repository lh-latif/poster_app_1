function init_state(id) {
  return {
    post_id: id,
    post: {
      loading: true,
      data: {
        id: null,
        title: "",
        content: ""
      },
    },
    comments: {
      loaded: false,
      loading: null,
      data: []
    }
  };
}

function getPost(id) {
  return new Promise(function(resolve, reject) {
    const req = new XMLHttpRequest();
    req.open("GET", "/api/v1/posts/"+id);
    req.responseType = "json";
    req.addEventListener("load", resolve);
    req.addEventListener("error", reject);
    req.send();
  });
}

function getPostComment(id) {
  return new Promise(function(resolve, reject) {
    const req = new XMLHttpRequest();
    req.open("GET", "/api/v1/posts/"+id+"/comment");
    req.responseType = "json";
    req.addEventListener("load", resolve);
    req.addEventListener("error", reject);
    req.send();
  });
}

export default {
  namespaced: true,
  state: init_state(null),
  mutations: {
    initStatePost: function(state, payload)
    {
      state.post_id = payload.data;
    },
    getPostResp: function(state, payload)
    {
      if (state.post_id == payload.data.id) {
        state.post = {
          loading: false,
          result: payload.result,
          data: payload.data
        };
      }

    },
    getPostCommentResp: function(state, payload)
    {
      if (state.post_id == payload.post_id) {
        state.comments = {
          loaded: true,
          loading: false,
          result: payload.result,
          data: payload.data
        };
      }

    }
  },
  actions: {
    initState: function({commit,dispatch}, payload)
    {
      commit({type: "initStatePost", data: payload.data});
      getPost(payload.data)
        .then(ev => {
          commit({
            type: "getPostResp",
            result: "ok",
            data: ev.target.response.data
          });
          dispatch({type: "getPostComment", data: payload.data});
          
        })

    },
    getPostComment: function({commit,state}, payload)
    {
      if (state.post_id == payload.data) {
        getPostComment(payload.data)
          .then((ev) => {
            commit({
              type: "getPostCommentResp",
              result: "ok",
              data: ev.target.response.data,
              post_id: payload.data
            });

          });
      }

    }
  }
};
