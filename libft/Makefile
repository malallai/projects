NAME = libft

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

NO_COLOR =		\x1b[0m
OK_COLOR =		\x1b[32;01m
ERROR_COLOR =	\x1b[31;01m
WARN_COLOR =	\x1b[33;01m
SILENT_COLOR = \x1b[30;01m

.PHONY: all re clean fclean

all: $(NAME)

%.o:
	@$(CC) -c $(subst .o,.c,$(subst $(OBJECTS_FOLDER),$(SOURCES_FOLDER),$(subst __,/,$@))) -I$(INCLUDES_FOLDER) $(FLAGS) -o $@
	@echo "$(OK_COLOR)✓$(NO_COLOR)"

$(NAME): $(OBJECTS)
	@echo "$(SILENT_COLOR)Compiling LibFt..$(NO_COLOR)"
	@ar rc $(NAME).a $(OBJECTS)
	@echo "$(OK_COLOR)Successful. ✓$(NO_COLOR)"

clean:
	@rm -f $(OBJECTS)
	@echo "$(SILENT_COLOR)$(NAME) : Cleaned Objects.$(NO_COLOR)"

fclean: clean
	@rm -f $(NAME).a
	@echo "$(SILENT_COLOR)$(NAME) : Cleaned Library.$(NO_COLOR)"

re: fclean all