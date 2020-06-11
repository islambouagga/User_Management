export default class Gate {
    constructor(user) {
        this.user=user;
    }
    isAdmin(){
        return this.user.type === 'admin'
    }
    isAuthor(){
        return this.user.type === 'author'
    }
    isUser(){
        return this.user.type === 'user'
    }
    isAdmin(){
        return this.user.type === 'user'
    }

    isAdminOrAuthor(){
        if(this.user.type === 'admin' || this.user.type === 'author'){
            return true;
        }

    }
    isAuthorOrUser(){
        if(this.user.type === 'user' || this.user.type === 'author'){
            return true;
        }

    }
}
