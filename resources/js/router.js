import Home from "./components/Home.vue";
import Login from "./components/Login.vue";
import UserDashboard from "./components/UserDashboard.vue";
import UserPostForm from "./components/UserPostForm.vue";
import PostView from "./components/PostView.vue";
import Registration from "./components/Registration.vue";

export default function(VueRouter) {
  return new VueRouter({
    routes: [
      {
        path: "/posts/:id",
        component: PostView
      },
      {
        path: "/login",
        component: Login,
        meta: {
          authExclude: true
        }
      },
      {
        path: "/account",
        component: UserDashboard,
        meta: {
          authGuard: true,
        },
      },
      {
        path: "/account/post",
        component: UserPostForm,
        meta: {
          authGuard: true,
        },
      },
      {
        path: "/",
        component: Home
      }
    ]
  })
}
