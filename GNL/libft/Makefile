NAME = libft.a
PROJECT_NAME = LibFt

SOURCES_FOLDER = sources/
INCLUDES_FOLDER = includes/
OBJECTS_FOLDER = objects/

SOURCES = \
	ft_abs.c \
	ft_atoi.c \
	ft_bzero.c \
	ft_isalnum.c \
	ft_isalpha.c \
	ft_isascii.c \
	ft_isdigit.c \
	ft_islower.c \
	ft_isprint.c \
	ft_isspace.c \
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
	ft_strccpy.c \
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
	ft_trimchar.c \

OBJECTS = $(SOURCES:.c=.o)
OBJECTS := $(subst /,__,$(OBJECTS))
OBJECTS := $(addprefix $(OBJECTS_FOLDER),$(OBJECTS))
SOURCES := $(addprefix $(SOURCES_FOLDER),$(SOURCES))

FLAGS = -Wall -Wextra -Werror -fPIC
CC = clang

NO_COLOR =		\033[38;5;0m
OK_COLOR =		\033[38;5;2m
ERROR_COLOR =	\033[38;5;1m
WARN_COLOR =	\033[38;5;3m
SILENT_COLOR =	\033[38;5;245m
INFO_COLOR =	\033[38;5;45m

.PHONY: all re clean fclean so

all: $(NAME)

$(NAME): $(OBJECTS)
	@ar rc $(NAME) $(OBJECTS)
	@ranlib $(NAME)
	@echo "$(WARN_COLOR)$(NAME) successfully compiled. $(OK_COLOR)✓$(NO_COLOR)"

$(OBJECTS_FOLDER)%.o: $(SOURCES_FOLDER)%.c
	@$(CC) $(FLAGS) -I$(INCLUDES_FOLDER) -c $< -o $@
	@printf "$(INFO_COLOR)$<$(SILENT_COLOR)\t➤ $(INFO_COLOR)$@ $(NO_COLOR)"
	@echo "$(OK_COLOR)✓ $(NO_COLOR)"

so: $(OBJECTS)
	@$(CC) $(FLAGS) -shared -o $(subst .a,.so,$(NAME)) $(OBJECTS)
	@echo "$(WARN_COLOR)$(subst .a,.so,$(NAME)) successfully compiled. $(OK_COLOR)✓$(NO_COLOR)"

clean:
	@rm -f $(OBJECTS)
	@echo "$(WARN_COLOR)$(PROJECT_NAME) $(SILENT_COLOR): $(WARN_COLOR)Clean $(OK_COLOR)✓.$(NO_COLOR)"

fclean: clean
	@rm -f $(NAME)
	@rm -f $(subst .a,.so,$(NAME))
	@echo "$(WARN_COLOR)$(PROJECT_NAME) $(SILENT_COLOR): $(WARN_COLOR)Fclean $(OK_COLOR)✓.$(NO_COLOR)"

re: fclean all
