import moment from 'moment';
export default {
    ordersSortedByCreatedDate: state => Object.values(state.orders)
        .sort(
            (a, b) => (
                moment(b.created) - moment(a.created)
            )
    ),

}