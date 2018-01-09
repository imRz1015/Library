const mutations = {
    changeLoginIDMu: (state, { id, userimg }) => {
        state.login.loginID = id;
        state.login.userimg = userimg;
    }
};
export default mutations;
