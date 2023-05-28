DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS restaurants;
DROP TABLE IF EXISTS dishes;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS categorias;
DROP TABLE IF EXISTS profilePic;
DROP TABLE IF EXISTS restaurantReviews;
DROP TABLE IF EXISTS dishesReviews;
DROP TABLE IF EXISTS restaurantFavorites;
DROP TABLE IF EXISTS dishesFavorites;
DROP TABLE IF EXISTS profilePic;
DROP TABLE IF EXISTS dishPriceHistory;
DROP TABLE IF EXISTS reviewResponsesRest;
DROP TABLE IF EXISTS reviewResponsesDish;




CREATE TABLE categorias (
    id INTEGER PRIMARY KEY,
    categoria VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE users (
    id INTEGER PRIMARY KEY NOT NULL,
    email VARCHAR NOT NULL,
    username VARCHAR NOT NULL,
    morada VARCHAR,
    psw VARCHAR NOT NULL,
    phonenu INTEGER,
    bio VARCHAR,
    userPicture INTEGER REFERENCES profilePic(id),
    numOfReviews INTEGER
);

CREATE TABLE restaurants (
    id INTEGER PRIMARY KEY NOT NULL,
    email VARCHAR NOT NULL,
    bio VARCHAR NOT NULL,
    psw VARCHAR NOT NULL,
    Rname VARCHAR NOT NULL,
    morada VARCHAR NOT NULL,
    city VARCHAR NOT NULL,
    slogan VARCHAR NOT NULL,
    categoria VARCHAR,
    numOfReviews INTEGER,
    avgScore REAL,
    dono INTEGER
);

CREATE TABLE restaurantReviews (
    id INTEGER NOT NULL PRIMARY KEY,
    Rid INTEGER NOT NULL REFERENCES restaurants(id), 
    score INTEGER,
    content TEXT,
    userId INTEGER NOT NULL REFERENCES users(id)
);

CREATE TABLE restaurantFavorites (
    Rid INTEGER NOT NULL REFERENCES restaurants(id), 
    userId INTEGER NOT NULL REFERENCES users(id)
);

CREATE TABLE dishes (
    id INTEGER PRIMARY KEY,
    nome VARCHAR,
    preco REAL,
    descricao VARCHAR,
    restaurantId INTEGER NOT NULL REFERENCES restaurants(id),
    categoria VARCHAR,
    numberOfReviews INTEGER,
    avgScore REAL
);


CREATE TABLE dishesReviews(
    id INTEGER PRIMARY KEY NOT NULL,
    dishId INTEGER NOT NULL REFERENCES dishes(id), 
    userId INTEGER NOT NULL REFERENCES users(id),
    restaurantId INTEGER NOT NULL REFERENCES restaurants(Rid),
    conteudo VARCHAR,
    score INTEGER NOT NULL
);

CREATE TABLE dishesFavorites(
    dishId INTEGER NOT NULL REFERENCES dishes(id), 
    userId INTEGER NOT NULL REFERENCES users(id),
    restaurantId INTEGER NOT NULL REFERENCES restaurants(id)
);

CREATE TABLE orders (
    id INTEGER PRIMARY KEY,
    Pname VARCHAR REFERENCES dishes,
    content VARCHAR,
    username VARCHAR REFERENCES username
);


CREATE TABLE profilePic (
    id INTEGER NOT NULL PRIMARY KEY,
    --userId INTEGER NOT NULL REFERENCES users(id),
    imageurl VARCHAR NOT NULL
);

CREATE TABLE dishPriceHistory(
    id INTEGER NOT NULL PRIMARY KEY,
    dishId INTEGER NOT NULL REFERENCES dish(id),
    price REAL NOT NULL
);

CREATE TABLE reviewResponsesRest(
    reviewId INTEGER NOT NULL,
    restaurantId INTEGER NOT NULL,
    conteudo VARCHAR
);

CREATE TABLE reviewResponsesDish(
    reviewId INTEGER NOT NULL,
    dishId INTEGER NOT NULL,
    restaurantId INTEGER NOT NULL,
    conteudo VARCHAR
);


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
(1, 'randomEmail@gmail.com', 'A Viseu based restaurant that will make you go "Hmmmm"' ,'b10', 'Quinta do Bicho', 'Avenida António José de Almeida' , 'Viseu', 'Because food tastes good here', 'healthy', 0,0, 2),
(2, 'randomEmail@gmail.com', 'The best Viseu restaurant... Yeah... You heard it...' ,'a10', 'Viriatos', 'Avenida da Europa' , 'Viseu', 'Because food tastes good here', 'soup', 0, 0, 7),
(3, 'randomEmail@gmail.com', 'We make actual food that tastes good... Unlike Beast Master' ,'c10', 'O malhadinhas', 'Rua do Ouro' , 'Lisboa', 'Love us now!', 'healthy',0,0, 3),
(4, 'randomEmail@gmail.com', 'We make amazing food...' ,'m10', 'Beast Master', 'Rua Miguel Bombarda' , 'Lisboa', 'Cause we beast!', 'healthy',0, 0, 5);

INSERT INTO dishes VALUES
/*name, preco, description, restaurantId, categoria*/
(1, 'Sopa de Pedra', 3, 'A good soup', 1, 'soup', 0, 0),
(2, 'Bacalhau à Brás', 3, 'Amazing Codfish', 2, 'healthy', 0, 0),
(3, 'Arroz à Valenciana', 3, 'Best dish you will ever have', 1, 'soup', 0, 0),
(4, 'Pizza Napolitana', 3, 'Italiani', 1, 'pizza', 0,0);

INSERT INTO orders VALUES
/*id, dishId, username*/
(1, 2, 1, "luis10");

