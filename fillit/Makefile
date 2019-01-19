NAME = fillit
PROJECT_NAME = Fillit

SOURCES_FOLDER = ./
INCLUDES_FOLDER = ./
OBJECTS_FOLDER = ./

LIBS = libft

SOURCES = \
	fillit.c \
	map.c \
	solver.c \
	tetrimino.c \
	utils.c \
	maths.c \
	params.c \

MAIN = main.c

OBJECTS = $(SOURCES:.c=.o)

FLAGS = -Wall -Wextra -Werror -g3
CC = clang

NO_COLOR =		\033[38;5;15m
OK_COLOR =		\033[38;5;2m
ERROR_COLOR =	\033[38;5;1m
WARN_COLOR =	\033[38;5;3m
SILENT_COLOR =	\033[38;5;245m
INFO_COLOR =	\033[38;5;140m

.PHONY: all re clean fclean libft force

all: $(NAME)

$(LIBS):
	@printf "\n$(NO_COLOR)-------- $(INFO_COLOR)Libft $(NO_COLOR)--------\n"
	@make -C $(@)
	@printf "$(NO_COLOR)-----------------------\n\n"

$(NAME): $(OBJECTS) $(LIBS)
	@printf "$(NO_COLOR)All objects for $(INFO_COLOR)$(PROJECT_NAME) $(NO_COLOR)where successfully created.\n"
	@$(CC) $(FLAGS) -I$(INCLUDES_FOLDER) -o $(NAME) $(OBJECTS) -L libft/ -lft
	@printf "$(INFO_COLOR)$(NAME) $(NO_COLOR)successfully compiled. $(OK_COLOR)✓$(NO_COLOR)\n"

force: $(OBJECTS)
	@printf "$(NO_COLOR)All objects for $(INFO_COLOR)$(PROJECT_NAME) $(NO_COLOR)where successfully created.\n"
	@$(CC) $(FLAGS) -I$(INCLUDES_FOLDER) -o $(NAME) $(OBJECTS) -L libft/ -lft
	@printf "$(INFO_COLOR)$(NAME) $(NO_COLOR)successfully compiled. $(OK_COLOR)✓$(NO_COLOR)\n"

$(OBJECTS_FOLDER)%.o: $(SOURCES_FOLDER)%.c
	@$(CC) $(FLAGS) -I$(INCLUDES_FOLDER) -c $< -o $@
	@printf "$(NO_COLOR)Creating $(INFO_COLOR)%-30s $(OK_COLOR)✓$(NO_COLOR)\r" "$@"

clean:
	@rm -f $(OBJECTS)
	@make -C $(LIBS) clean
	@printf "$(INFO_COLOR)$(PROJECT_NAME) $(NO_COLOR)Removed all objects$(NO_COLOR).\n"

fclean: clean
	@rm -f $(NAME)
	@make -C $(LIBS) fclean
	@printf "$(INFO_COLOR)$(PROJECT_NAME) $(NO_COLOR)Removed $(INFO_COLOR)$(NAME)$(NO_COLOR).\n"

re: fclean all
