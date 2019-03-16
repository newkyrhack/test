import Form from './components/FormComponent'
import Table from './components/TableComponent'


const routes = [
    { path: '/', redirect:'table' },
    { path: '/form', name:'form', component: Form },
    { path: '/table', name:'table', component: Table },
    { path: '/edit/:id', name:'edit', component: Form, props:true },
]

export default routes