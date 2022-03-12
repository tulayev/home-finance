import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Dashboard from '../views/Dashboard.vue'
import Profile from '../views/Profile.vue'
import CategoryIndex from '../views/category/Index.vue'
import CategoryCreate from '../views/category/Create.vue'
import CategoryEdit from '../views/category/Edit.vue'
import RecordIndex from '../views/record/Index.vue'
import RecordCreate from '../views/record/Create.vue'
import RecordEdit from '../views/record/Edit.vue'

const routes = [
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    },
    {
        path: '/',
        name: 'Home',
        component: Home,
        children: [
            {path: 'profile', name: 'Profile', component: Profile},
            {path: 'dashboard', name: 'Dashboard', component: Dashboard},
            {path: 'categories', name: 'Category', component: CategoryIndex},
            {path: 'categories/create', name: 'Category.Create', component: CategoryCreate},
            {path: 'categories/:id/edit', name: 'Category.Edit', component: CategoryEdit},
            {path: 'records', name: 'Record', component: RecordIndex},
            {path: 'records/create', name: 'Record.Create', component: RecordCreate},
            {path: 'records/:id/edit', name: 'Record.Edit', component: RecordEdit}
        ]
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
