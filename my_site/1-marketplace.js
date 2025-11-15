// Prototype pour un groupe d'articles
function ItemGroup(name, price, quantity) {
    this.name = name;
    this.price = price;
    this.quantity = quantity;
}

// Prototype du panier
function Cart() {
    this.itemGroups = [];

    // Méthode pour ajouter un groupe d’articles
    this.addItemGroup = function(itemGroup) {
        this.itemGroups.push(itemGroup);
    };

    // Méthode pour calculer le total
    this.getTotalAmount = function() {
        let amount = 0;
        for (let i = 0; i < this.itemGroups.length; i++) {
            amount += this.itemGroups[i].price * this.itemGroups[i].quantity;
        }
        return amount;
    };

    // Méthode pour afficher le total
    this.showTotalAmount = function() {
        if (this.itemGroups.length === 0) {
            document.write("<p>You have 0 item, for a total amount of $0.00 in your cart!</p>");
        } else {
            let total = this.getTotalAmount();
            let taxes = total * 0.14975; // environ 15 % de taxes
            let totalWithTaxes = total + taxes;

            document.write("<p>");
            document.write("You have " + this.itemGroups.length + " item groups in your cart.<br>");
            document.write("Total before tax: $" + total.toFixed(2) + "<br>");
            document.write("Total with tax: $" + totalWithTaxes.toFixed(2));
            document.write("</p>");
        }
    };
}

// ==== TEST DU CODE ====
document.write("<h2>1) Creating the cart</h2>");
let my_cart = new Cart();
my_cart.showTotalAmount();

document.write("<h2>2) Adding 15 pants at 10.05$ each to the cart!</h2>");
let pants = new ItemGroup("pants", 10.05, 15);
my_cart.addItemGroup(pants);
my_cart.showTotalAmount();

document.write("<h2>3) Adding 1 coat at 99.99$ to the cart!</h2>");
let coat = new ItemGroup("coat", 99.99, 1);
my_cart.addItemGroup(coat);
my_cart.showTotalAmount();
