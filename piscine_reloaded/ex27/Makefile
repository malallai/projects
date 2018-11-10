# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Makefile                                           :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: malallai <malallai@student.42.fr>          +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2018/11/06 14:20:41 by malallai          #+#    #+#              #
#    Updated: 2018/11/06 15:54:21 by malallai         ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

NAME=ft_display_file
SRCS_FILES= main.c \
			ft_display_file.c \
			utils.c
HEADERS_FOLDER= .
FLAGS=
OBJ= $(SRCS_FILES:.c=.o)

.PHONY: fclean clean all re

all: $(NAME)

$(NAME):
	gcc $(FLAGS) -I $(HEADERS_FOLDER) $(SRCS_FILES) -o $(NAME)

clean:
	rm -f $(OBJ)

fclean: clean
	rm -f $(NAME)

re: fclean all
