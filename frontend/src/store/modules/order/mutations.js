import { ORDER_ADD, ORDERS_SET, ORDER_SET_PROCESSED, ORDER_SET_UNPROCESSED, ORDER_REMOVE } from './mutationTypes';
import { orderMapper } from '@/services/Normalizer';
import Vue from 'vue';

export default {
    [ORDER_ADD]: (state, order) => {
        state.orders = {
            ...state.orders,
            [order.id]: orderMapper(order)
        };
    },

    [ORDERS_SET]: (state, orders) => {
        state.orders = {
            ...state.orders,
            ...orders.reduce(
                (prev, order) => ({ ...prev, [order.id]: orderMapper(order) }), {}
            ),
        };
    },

    [ORDER_SET_PROCESSED]: (state, id) => {
        state.orders[id].processed = true;
    },

    [ORDER_SET_UNPROCESSED]: (state, id) => {
        state.orders[id].processed = false;
    },

    [ORDER_REMOVE]: (state, id) => {
        Vue.delete (state.orders, id);
    }
}