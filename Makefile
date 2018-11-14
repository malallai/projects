NAME = libft.a

SOURCES_FOLDER = ./
INCLUDES_FOLDER = ./
OBJECTS_FOLDER = ./

SOURCES = \
	ft_atoi.c \
	ft_atoi_base.c \
	ft_bzero.c \
	ft_isalnum.c \
	ft_isalpha.c \
	ft_isascii.c \
	ft_isdigit.c \
	ft_islower.c \
	ft_isprint.c \
	ft_isupper.c \
	ft_itoa.c \
	ft_lstadd.c \
	ft_lstdel.c \
	ft_lstdelone.c \
	ft_lstiter.c \
	ft_lstmap.c \
	ft_lstnew.c \
	ft_memalloc.c \
	ft_memccpy.c \
	ft_memchr.c \
	ft_memcmp.c \
	ft_memcpy.c \
	ft_memdel.c \
	ft_memmove.c \
	ft_memset.c \
	ft_putchar.c \
	ft_putchar_fd.c \
	ft_putendl.c \
	ft_putendl_fd.c \
	ft_putnbr.c \
	ft_putnbr_fd.c \
	ft_putstr.c \
	ft_putstr_fd.c \
	ft_strcat.c \
	ft_strchr.c \
	ft_strclr.c \
	ft_strcmp.c \
	ft_strcpy.c \
	ft_strdel.c \
	ft_strdup.c \
	ft_strequ.c \
	ft_striter.c \
	ft_striteri.c \
	ft_strjoin.c \
	ft_strlcat.c \
	ft_strlen.c \
	ft_strmap.c \
	ft_strmapi.c \
	ft_strncat.c \
	ft_strncmp.c \
	ft_strncpy.c \
	ft_strnequ.c \
	ft_strnew.c \
	ft_strnstr.c \
	ft_strrchr.c \
	ft_strsplit.c \
	ft_strstr.c \
	ft_strsub.c \
	ft_strtrim.c \
	ft_tolower.c \
	ft_toupper.c \

OBJECTS = $(SOURCES:.c=.o)

FLAGS = -Wall -Wextra -Werror
CC = clang

NO_COLOR =		\033[38;5;0m
OK_COLOR =		\033[38;5;32m
ERROR_COLOR =	\033[38;5;31m
WARN_COLOR =	\033[38;5;33m
SILENT_COLOR = \033[38;5;30m
INFO_COLOR = \033[38;5;34m

.PHONY: all re clean fclean

all: $(NAME)

$(NAME): $(OBJECTS)
	@echo "$(WARN_COLOR)Compiling LibFt..$(NO_COLOR)"
	@ar rc $(NAME) $(OBJECTS)
	@echo "$(OK_COLOR)Successful. ✓$(NO_COLOR)"

%.o:
	@$(CC) -c $(subst .o,.c,$@) -I$(INCLUDES_FOLDER) $(FLAGS) -o $@
	@printf "$(INFO_COLOR)$(subst .o,.c,$@).. $(NO_COLOR)"
	@echo "$(OK_COLOR)✓ $(NO_COLOR)"

so%.o:
	@$(CC) -c -fPIC $(subst .o,.c,$(subst so,  ,$@)) -I$(INCLUDES_FOLDER) $(FLAGS)
	@printf "$(INFO_COLOR)$(subst .o,.c,$(subst so,  ,$@)).. $(NO_COLOR)"
	@echo "$(OK_COLOR)✓ $(NO_COLOR)"

so: so$(OBJECTS)
	@echo "$(WARN_COLOR)Compiling LibFt.. So$(NO_COLOR)"
	@$(CC) $(FLAGS) -shared -fPIC -o $(subst .a,.so,$(NAME)) $(OBJECTS)
	@echo "$(OK_COLOR)Successful. ✓$(NO_COLOR)"

clean:
	@rm -f $(OBJECTS)
	@echo "$(OK_COLOR)$(NAME) : Cleaned Objects.$(NO_COLOR)"

fclean: clean
	@rm -f $(NAME)
	@rm -f $(subst .a,.so,$(NAME))
	@echo "$(OK_COLOR)$(NAME) : Cleaned Library.$(NO_COLOR)"

re: fclean all
