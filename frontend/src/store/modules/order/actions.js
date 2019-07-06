import { ORDER_ADD, ORDERS_SET } from './mutationTypes';
import api from '@/api/Api';
import { SET_LOADING } from '../../mutationTypes';
import { orderMapper } from '@/services/Normalizer';

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
};
