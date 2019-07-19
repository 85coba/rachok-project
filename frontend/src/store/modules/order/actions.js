import { ORDERS_SET, ORDER_SET_PROCESSED, ORDER_SET_UNPROCESSED } from './mutationTypes';
import api from '@/api/Api';
import { SET_LOADING } from '../../mutationTypes';
import { orderMapper, equipmentMapper } from '@/services/Normalizer';
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
            await axios.post(`${process.env.VUE_APP_API_URL}/order/add`, 
                {
                    title: order.title,
                    info: order.info,
                    features: order.features,
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

            
            commit(SET_LOADING, false, {root: true});
        } catch(error) {
            commit(SET_LOADING, false, {root: true});
            return Promise.reject(error);
        }
    },

    async fetchEquipments( {commit} ) {
        commit (SET_LOADING, true, {root: true});
        
        try {
            let equipments=[];
            await axios.get(`${process.env.VUE_APP_API_URL}/equipments`,
                {
                    headers: { 'X-Socket-ID': getSocketId() }
                }
            ).then((res)=>{equipments = res.data.data;});
            commit(SET_LOADING, false, {root: true});
            return Promise.resolve(equipments.map(equipmentMapper));
        } catch (error) {
            commit(SET_LOADING, false, {root: true});
            return Promise.reject(error);
        }
    },

    async processed ( {commit}, id ) {
        commit(SET_LOADING, true, {root: true});

        try {
            await api.post(`${process.env.VUE_APP_API_URL}/process`,{ id: id });

            commit(ORDER_SET_PROCESSED, id);
            commit(SET_LOADING, false, {root: true});
        } catch(error) {
            commit(SET_LOADING, false, {root: true});
            return Promise.reject(error);
        }
    },
    
    async unProcessed ( {commit}, id ) {
        commit(SET_LOADING, true, {root: true});

        try {
            await api.post(`${process.env.VUE_APP_API_URL}/unprocess`,{ id: id });

            commit(ORDER_SET_UNPROCESSED, id);
            commit(SET_LOADING, false, {root: true});
        } catch(error) {
            commit(SET_LOADING, false, {root: true});
            return Promise.reject(error);
        }
    } 


};
