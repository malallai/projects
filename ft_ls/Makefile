NAME = ft_ls
PROJECT_NAME = ft_ls

SOURCES_FOLDER = ./
INCLUDES_FOLDER = ./
OBJECTS_FOLDER = ./

LIBS = libft

SOURCES = \
	ft_ls.c \
	display.c \
	parser.c \
	utils.c \

OBJECTS = $(SOURCES:.c=.o)

FSANITIZE = -fsanitize=address
FLAGS =
CC = clang

NO_COLOR =		\033[38;5;15m
OK_COLOR =		\033[38;5;2m
ERROR_COLOR =	\033[38;5;1m
WARN_COLOR =	\033[38;5;3m
SILENT_COLOR =	\033[38;5;245m
INFO_COLOR =	\033[38;5;140m

.PHONY: all re clean fclean libft force doclean

all: $(NAME)

$(LIBS):
	@printf "$(NO_COLOR)All objects for $(INFO_COLOR)$(PROJECT_NAME) $(NO_COLOR)where successfully created.\n"
	@printf "\n$(NO_COLOR)-------- $(INFO_COLOR)Libft $(NO_COLOR)--------\n"
	@make -C $(@)
	@printf "$(NO_COLOR)-----------------------\n\n"

$(NAME): $(OBJECTS) $(LIBS)
	@$(CC) $(FLAGS) -I$(INCLUDES_FOLDER)  -o $(NAME)  -L libft/ -lft $(OBJECTS)
	@printf "$(INFO_COLOR)$(NAME) $(NO_COLOR)successfully compiled. $(OK_COLOR)✓$(NO_COLOR)\n"

force: $(OBJECTS)
	@printf "$(NO_COLOR)All objects for $(INFO_COLOR)$(PROJECT_NAME) $(NO_COLOR)where successfully created.\n"
	@$(CC) $(FLAGS) -I$(INCLUDES_FOLDER) -o $(NAME) $(OBJECTS) -L libft/ -lft
	@printf "$(INFO_COLOR)$(NAME) $(NO_COLOR)successfully compiled. $(OK_COLOR)✓$(NO_COLOR)\n"

%.o: %.c
	@$(CC) $(FLAGS) -I$(INCLUDES_FOLDER) -c $< -o $@
	@printf "$(NO_COLOR)Creating $(INFO_COLOR)%-30s $(OK_COLOR)✓$(NO_COLOR)\r" "$@"

clean:
	@make -C $(LIBS) clean
	@rm -f $(OBJECTS)
	@printf "$(INFO_COLOR)$(PROJECT_NAME) $(NO_COLOR)Removed all objects$(NO_COLOR).\n"

fclean: clean
	@make -C $(LIBS) fclean
	@rm -f $(NAME)
	@printf "$(INFO_COLOR)$(PROJECT_NAME) $(NO_COLOR)Removed $(INFO_COLOR)$(NAME)$(NO_COLOR).\n"

doclean: all clean

re: fclean all
