# API Documentation


## Get Jewelry Types

**URL**: `/api/jewelry`

**Method**: `GET`

**Description**: Retrieves a list of jewelry types, including their IDs and names.

### Request

No parameters required.

### Response

```Json
{
    "status": "success",
    "message": "Jewelry types retrieved successfully.",
    "data": [
        {
            "id": 1,
            "name": "Helmet"
        },
        {
            "id": 6,
            "name": "Necklace"
        },
        {
            "id": 7,
            "name": "Gold"
        }
    ]
}
```

## Get Decor Types

**URL**: `/api/home_decor`

**Method**: `GET`

**Description**: Retrieves a list of decor types, including their IDs and names.

### Request

No parameters required.

### Response

```Json
{
     "status": "success",
    "message": "Home Decor types retrieved successfully.",
    "data": [
        {
            "id": 2,
            "name": "Ring"
        },
        {
            "id": 3,
            "name": "Braccelet"
        },
        {
            "id": 4,
            "name": "Gold Ring"
        },
        {
            "id": 5,
            "name": "Silver Ring"
        }
    ]
}
```

## Get Products by Type

**URL**: `/api/products?type={type_id}`

**Method**: `GET`

**Description**: Retrieves a list of products of added type_id.

### Request

type_id parameter required.

### Response

```Json
{
    "status": "success",
    "message": "Products retrieved successfully.",
    "data": [
        {
            "id": 1,
            "title": "Coper Helmet",
            "description": "Description for Product 1",
            "price": "100.00",
            "sale_price": "90.00",
            "is_featured": 1,
            "category_id": 1,
            "type_id": 1,
            "dimensions": "20 x 30 cm",
            "weight": "2.50",
            "quantity": 50,
            "is_discounted": 1,
            "created_at": "2024-02-17T21:16:25.000000Z",
            "updated_at": "2024-02-17T21:16:25.000000Z",
            "deleted_at": null
        }
    ]
}
```

## Get FAQ`s

**URL**: `/api/faqs`

**Method**: `GET`

**Description**: Retrieves a list all FAQ`s.

### Request

No parameters required.

### Response

```Json
{
    "status": "success",
    "message": "FAQs retrieved successfully.",
    "data": [
        {
            "id": 1,
            "question": "What is Lorem Ipsum?",
            "answer": "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
        },
        {
            "id": 2,
            "question": "How can I install Laravel?",
            "answer": "You can install Laravel using Composer. Run \"composer create-project --prefer-dist laravel/laravel project-name\" in your terminal.",
            "created_at": null,
            "updated_at": null,
            "deleted_at": null
        }
    ]
}
```

## Get User Cart Products

**URL**: `/api/cart-items?user_id={user_id}`

**Method**: `GET`

**Description**: Retrieves a list of cart products with full info for specified user(user_id) .

### Request

user_id parameter required.

### Response

```Json
{
    "status": "success",
    "message": "Cart items retrieved successfully.",
    "data": [
        {
            "id": 2,
            "title": "Silver Ring",
            "description": "Description for Product 2",
            "price": "120.00",
            "sale_price": "110.00",
            "is_featured": 0,
            "category_id": 2,
            "type_id": 2,
            "dimensions": "25 x 35 cm",
            "weight": "3.00",
            "quantity": 30,
            "is_discounted": 0,
            "created_at": "2024-02-17T21:16:25.000000Z",
            "updated_at": "2024-02-17T21:16:25.000000Z",
            "deleted_at": null
        }
    ]
}
```

## Get User Favorite Products

**URL**: `/api/favorite-items?user_id={user_id}`

**Method**: `GET`

**Description**: Retrieves a list of favorite products with full info for specified user(user_id) .

### Request

user_id parameter required.

### Response

```Json
{
    "status": "success",
    "message": "Favorite items retrieved successfully.",
    "data": [
        {
            "id": 2,
            "title": "Silver Ring",
            "description": "Description for Product 2",
            "price": "120.00",
            "sale_price": "110.00",
            "is_featured": 0,
            "category_id": 2,
            "type_id": 2,
            "dimensions": "25 x 35 cm",
            "weight": "3.00",
            "quantity": 30,
            "is_discounted": 0,
            "created_at": "2024-02-18T09:57:09.000000Z",
            "updated_at": "2024-02-18T09:57:09.000000Z",
            "deleted_at": null
        }
    ]
}
```


## Get Custom Order Images

**URL**: `/api/custom_order_gallery`

**Method**: `GET`

**Description**: Retrieves a 8(most recent) images(url`s) from custom order galery.

### Request

No parameters required.

### Response

```Json
{
    "status": "success",
    "message": "Custom order images fetched successfully.",
    "data": [
        "somerandomurl.com",
        "somerandomurl2.com"
    ]
}
```

## Post Custom Order 

**URL**: `/api/custom_order_gallery`

**Method**: `POST`

**Description**: Post client Custom Order.

### Request

user_id, name(optional), email, message, images(optional), send_link(optional)

### Response

```Json
{
    "status": "success",
    "message": "Custom order submitted successfully.",
    "data": {
        "user_id": "2",
        "name": "example name",
        "email": "example@mail.com",
        "message": "example message",
        "images": "imageurl",
        "send_link": "linkurl",
        "updated_at": "2024-02-18T09:30:44.000000Z",
        "created_at": "2024-02-18T09:30:44.000000Z",
        "id": 3
    }
}
```

## Post Customer Question 

**URL**: `/api/questions`

**Method**: `POST`

**Description**: Post Customer Question that is not answered in FAQ section.

### Request

name, email, question

### Response

```Json
{
    "status": "success",
    "message": "Question saved successfully",
    "data": {
        "name": "John Doe",
        "email": "example@gmail.com",
        "question": "Example question",
        "updated_at": "2024-02-18T11:46:35.000000Z",
        "created_at": "2024-02-18T11:46:35.000000Z",
        "id": 2
    }
}
```