# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Makefile                                           :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: malallai <malallai@student.42.fr>          +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2018/11/06 14:20:41 by malallai          #+#    #+#              #
#    Updated: 2018/11/06 16:35:47 by malallai         ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

NAME=libft.a
SRCS_FILES= srcs/ft_putchar.c \
			srcs/ft_putstr.c \
			srcs/ft_strcmp.c \
			srcs/ft_strlen.c \
			srcs/ft_swap.c
HEADERS_FOLDER= includes
FLAGS= -Wall -Wextra -Werror
OBJ= $(subst srcs/, ,$(SRCS_FILES:.c=.o))

.PHONY: fclean clean all re

all: $(NAME)

$(NAME):
	gcc $(FLAGS) -I $(HEADERS_FOLDER) -c $(SRCS_FILES)
	ar rc $(NAME) $(OBJ)
	ranlib $(NAME)

clean:
	rm -f $(OBJ)

fclean: clean
	rm -f $(NAME)

re: fclean all
