import {reactive} from 'vue';

let cart = reactive([]);

const addProductToCart = (product) => {
    const existingProduct = cart.find(p => p.id === product.id);
    if (existingProduct) {
        existingProduct.amount++;
    } else {
        cart.push(product);
    }
};

const removeProduct = (productId) => {
    const index = cart.findIndex(product => product.id === productId);
    if (index !== -1) {
        cart.splice(index, 1);
    }
};

const changeProductAmount = (productId, newAmount) => {
    const productIndex = cart.findIndex(product => product.id === productId);
    if (productIndex !== -1) {
        cart[productIndex].amount = newAmount;
    }
};

const getCart = () => {
    return cart;
};

export {addProductToCart, removeProduct, changeProductAmount, getCart};