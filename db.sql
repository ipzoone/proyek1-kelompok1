create database pamayahan;
create user 'pamayahan'@'localhost' identified by 'password';
grant all privileges on pamayahan.* to 'pamayahan'@'localhost';
use pamayahan;
create table users (
    id int auto_increment primary key,
    username varchar(50) not null,
    password varchar(255) not null,
    created_at timestamp default current_timestamp
);
create table posts (
    id int auto_increment primary key,
    user_id int not null,
    title varchar(255) not null,
    content text not null,
    created_at timestamp default current_timestamp,
    foreign key (user_id) references users(id) on delete cascade
);
create table comments (
    id int auto_increment primary key,
    post_id int not null,
    user_id int not null,
    content text not null,
    created_at timestamp default current_timestamp,
    foreign key (post_id) references posts(id) on delete cascade,
    foreign key (user_id) references users(id) on delete cascade
);
create table likes (
    id int auto_increment primary key,
    post_id int not null,
    user_id int not null,
    created_at timestamp default current_timestamp,
    foreign key (post_id) references posts(id) on delete cascade,
    foreign key (user_id) references users(id) on delete cascade
);
create table messages (
    id int auto_increment primary key,
    sender_id int not null,
    receiver_id int not null,
    content text not null,
    created_at timestamp default current_timestamp,
    foreign key (sender_id) references users(id) on delete cascade,
    foreign key (receiver_id) references users(id) on delete cascade
);
create table notifications (
    id int auto_increment primary key,
    user_id int not null,
    type varchar(50) not null,
    message text not null,
    is_read boolean default false,
    created_at timestamp default current_timestamp,
    foreign key (user_id) references users(id) on delete cascade
);
create table friendships (
    id int auto_increment primary key,
    user_id int not null,
    friend_id int not null,
    status enum('pending', 'accepted', 'declined') default 'pending',
    created_at timestamp default current_timestamp,
    foreign key (user_id) references users(id) on delete cascade,
    foreign key (friend_id) references users(id) on delete cascade
);
create table groups (
    id int auto_increment primary key,
    name varchar(255) not null,
    description text,
    created_at timestamp default current_timestamp
);
create table group_members (
    id int auto_increment primary key,
    group_id int not null,
    user_id int not null,
    role enum('admin', 'member') default 'member',
    created_at timestamp default current_timestamp,
    foreign key (group_id) references groups(id) on delete cascade,
    foreign key (user_id) references users(id) on delete cascade
);
create table group_posts (
    id int auto_increment primary key,
    group_id int not null,
    user_id int not null,
    title varchar(255) not null,
    content text not null,
    created_at timestamp default current_timestamp,
    foreign key (group_id) references groups(id) on delete cascade,
    foreign key (user_id) references users(id) on delete cascade
);
create table group_comments (
    id int auto_increment primary key,
    group_post_id int not null,
    user_id int not null,
    content text not null,
    created_at timestamp default current_timestamp,
    foreign key (group_post_id) references group_posts(id) on delete cascade,
    foreign key (user_id) references users(id) on delete cascade
);
create table group_likes (
    id int auto_increment primary key,
    group_post_id int not null,
    user_id int not null,
    created_at timestamp default current_timestamp,
    foreign key (group_post_id) references group_posts(id) on delete cascade,
    foreign key (user_id) references users(id) on delete cascade
);