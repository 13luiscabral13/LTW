INSERT INTO categorias VALUES
(1, 'barbecue'),
(2, 'chinese'),
(3, 'hamburger'),
(4, 'healthy'),
(5, 'indian'),
(6, 'pizza'),
(7, 'soup'),
(8,'sushi'),
(9, 'thai'),
(10, 'vegan');

INSERT INTO restaurants VALUES
/*email, psw, Rname, city, info, categoriaId */
(1, 'luiscabral10@gmail.com', 'luis10', 'Quinta do Bicho', 'Viseu', 'healthy'),
(1, 'luiscabral10@gmail.com', 'luis10', 'Quinta do Bicho', 'Viseu', 'soup'),

INSERT INTO dishes VALUES
/*Pname, preço, restaurantId, categoriaId*/
(1, 'Sopa da pedra', 6, 1, 7),
(2, 'Salada', 3, 1, 4);

INSERT INTO users VALUES
/*email, psw, username*/
(1, 'sofiagoncalves@gmail.com', 'sofia19', 1);

INSERT INTO orders VALUES
/*id, dishId, username*/
(1, 2, 1);