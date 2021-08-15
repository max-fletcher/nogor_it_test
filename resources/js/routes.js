import Form from "./components/form";
import AllData from "./components/data";
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
         component: Form,
         name: 'Form',
         meta: { title: 'Form' }
      },
      {
         path: '/all_data',
         component: AllData,
         name: 'AllData',
         meta: { title: 'All Data' }
      },
   ]
}