import { ORDER_ADD, ORDERS_SET } from './mutationTypes';
import { orderMapper } from '@/services/Normalizer';

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
    }
}