// map api response into our custom format

export const userMapper = user => ({
    id: user.id,
    avatar: user.avatar,
    email: user.email,
    nickname: user.nickname,
    firstName: user.first_name,
    lastName: user.last_name,
});

export const emptyUser = () => ({
    id: null,
    avatar: null,
    email: '',
    nickname: '',
    firstName: '',
    lastName: '',
});

export const orderMapper = order => ({
    id: order.id,
    title: order.title,
    info: order.info,
    features: order.features,
    region: order.region,
    city: order.city,
    pib: order.pib,
    email: order.email,
    phoneNumber: order.phoneNumber,
    created: order.date
});
