 class Store {

     getUserData(data) {
         this.userData = data;
         this.userName = data.username;
         this.userId = data.id;
         
     }


 }

 export default new Store();