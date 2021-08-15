import Home from "./components/home";
import About from "./components/about";
import Login from "./components/login";
import Register from "./components/register";
import Dashboard from "./components/dashboard";
import NotFound from "./components/notfound";
import axios from "axios";

export default{
   mode: 'history',

   routes: [
      {
         path: '*',
         title: "Not Found",
         component: NotFound,
         name: 'NotFound',
         meta: { title: '404 Not Found' }
      },
      {
         path: '/',
         component: Home,
         name: 'Home',
         meta: { title: 'Home' }
      },
      {
         path: '/about',
         component: About,
         name: 'About',
         meta: { title: 'About Us' }
      },
      {
         path: '/login',
         component: Login,
         name: 'Login',
         meta: { title: 'Login' }
      },
      {
         path: '/register',
         component: Register,
         name: 'Register',
         meta: { title: 'Register' }
      },
      {
         path: '/dashboard',
         component: Dashboard,
         name: 'Dashboard',
         meta: { title: 'Dashboard' },
         // check if user is authenticated or not. If yes, process next request. Otherwise, send to login page.
         beforeEnter: ( to, from, next) => {
            axios.get('/api/authenticated')
            .then(()=>{
               next()
            }).catch(()=>{
               return next('/login')
            })
         }
      },      
   ]
}