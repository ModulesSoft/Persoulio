import Home from './components/Home'
import Profile from './components/Profile'
import Article from './components/Article'
import Login from './components/Login'
import Portfolio from './components/Portfolio'

export const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/portfolio',
        name: 'portfolio',
        component: Portfolio
    },
    {
        path: '/dashboard',
        name: 'Profile',
        component: Profile
    },
    {
        path: '/fun/article:id',
        name: 'Article',
        component: Article
    },
    {
        path: '/tunnel/article:id',
        name: 'Article',
        component: Article
    },
    // { path: "*", component: PageNotFound }
];
