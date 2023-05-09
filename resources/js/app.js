require('./bootstrap');

import { createApp } from 'vue';

import $ from "jquery";
import { configure, defineRule } from "vee-validate";

import UserProfile from './components/profile/index.vue';

import DashBroad from './components/DashBroad.vue';

import CategoryCreate from './components/category/create.vue';
import CategoryEdit from './components/category/edit.vue';

import UserCreate from './components/user/create.vue';
import UserEdit from './components/user/edit.vue';

import ExpenseCreate from './components/expense/create.vue';
import ExpenseEdit from './components/expense/edit.vue';

import ProductCreate from './components/product/create.vue';
import ProductEdit from './components/product/edit.vue';

import CustomerCreate from './components/customer/create.vue';
import CustomerEdit from './components/customer/edit.vue';

import CustomerGiftCard from './components/customer-gift-card/index.vue';
import UpdateGiftCard from './components/customer-gift-card/updateGiftCard.vue';

import LoginForm from './components/auth/login/index.vue';
import RegisterForm from './components/auth/register/index.vue';

import BookingCreate from './components/booking/create.vue';
import BookingEdit from './components/booking/edit.vue';

import GiftCardCreate from './components/gift-card/create.vue';
import GiftCardEdit from './components/gift-card/edit.vue';

import StockEdit from './components/stock/edit.vue';

import PosList from './components/pos/index.vue';

import CartList from './components/cart/index.vue';

import CalendarShow from './components/booking/calendar.vue';

import DataEmpty from './components/common/dataEmpty.vue';



const app = createApp({});

app.component("dash-broad", DashBroad);

app.component("category-create", CategoryCreate);
app.component("category-edit", CategoryEdit);

app.component("gift-card-create", GiftCardCreate);
app.component("gift-card-edit", GiftCardEdit);

app.component("booking-create", BookingCreate);
app.component("booking-edit", BookingEdit);

app.component("user-create", UserCreate);
app.component("user-edit", UserEdit);

app.component("expense-create", ExpenseCreate);
app.component("expense-edit", ExpenseEdit);

app.component("product-create", ProductCreate);
app.component("product-edit", ProductEdit);

app.component("customer-create", CustomerCreate);
app.component("customer-edit", CustomerEdit);

app.component("customer-gift-card", CustomerGiftCard);
app.component("update-gift-card", UpdateGiftCard);

app.component("stock-edit", StockEdit);

app.component("pos-list", PosList);

app.component("cart-list", CartList);

app.component("calendar-show", CalendarShow);

app.component("data-empty", DataEmpty);

app.component("login-form", LoginForm);
app.component("register-form", RegisterForm);

app.component("user-profile", UserProfile);

app.mount("#app");