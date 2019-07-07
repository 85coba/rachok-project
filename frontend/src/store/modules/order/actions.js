import { ORDER_ADD, ORDERS_SET } from './mutationTypes';
import api from '@/api/Api';
import { SET_LOADING } from '../../mutationTypes';
import { orderMapper } from '@/services/Normalizer';
import axios from 'axios/index';
import { getSocketId } from '@/services/Pusher';

export default {
    async fetchOrders({ commit }, { page }) {
        commit(SET_LOADING, true, {root: true});

        try {
            const orders = await api.get('/order/all', { page });

            commit(ORDERS_SET, orders);
            commit(SET_LOADING, false, {root: true});

            return Promise.resolve(orders.map(orderMapper));
        } catch (error) {
            commit(SET_LOADING, false, {root: true});
            return Promise.reject(error);
        }
    },

    async addOrder({ commit }, order) {
        commit (SET_LOADING, true, {root: true});
        try {
            const addOrder = await axios.post(`${process.env.VUE_APP_API_URL}/order/add`, 
                {
                    title: order.title,
                    info: order.info,
                    features: JSON.stringify(order.features),
                    pib: order.pib,
                    region: order.region,
                    city: order.city,
                    email: order.email,
                    phoneNumber: order.phoneNumber
                },
                {
                    headers: { 'X-Socket-ID': getSocketId() }
                }
                );

            commit(ORDER_ADD,addOrder);
            commit(SET_LOADING, false, {root: true});
        } catch(error) {
            commit(SET_LOADING, false, {root: true});
            return Promise.reject(error);
        }
    },
};
