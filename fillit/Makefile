NAME = fillit
PROJECT_NAME = Fillit

SOURCES_FOLDER = sources/
INCLUDES_FOLDER = includes/
OBJECTS_FOLDER = objects/
TESTFILES_FOLDER = files/
ULIMIT_FOLDER = ulimit/
OUTPUTS_FOLDER = outputs/

SOURCES = \
	main.c \
	fillit.c \
	tetromino.c \
	utils.c \
	pos.c \
	reader.c \

MAIN = main.c

DIRS = \
	$(TESTFILES_FOLDER) \
	$(OUTPUTS_FOLDER) \
	$(OBJECTS_FOLDER) \

OBJECTS = $(SOURCES:.c=.o)
OBJECTS := $(subst /,__,$(OBJECTS))
OBJECTS := $(addprefix $(OBJECTS_FOLDER),$(OBJECTS))
SOURCES := $(addprefix $(SOURCES_FOLDER),$(SOURCES))

FLAGS = -Wall -Wextra -Werror -g3
CC = clang

NO_COLOR =		\033[38;5;15m
OK_COLOR =		\033[38;5;2m
ERROR_COLOR =	\033[38;5;1m
WARN_COLOR =	\033[38;5;3m
SILENT_COLOR =	\033[38;5;245m
INFO_COLOR =	\033[38;5;140m

.PHONY: all re clean fclean libft dirs aclean libfclean ulclean

all: dirs $(NAME)

dirs:
	@mkdir -p $(DIRS)

$(NAME): libft $(OBJECTS)
	@printf "$(NO_COLOR)All objects for $(INFO_COLOR)$(PROJECT_NAME) $(NO_COLOR)where successfully created.\n"
	@$(CC) $(FLAGS) -I$(INCLUDES_FOLDER) -o $(NAME) $(OBJECTS) -L libft/ -lft
	@printf "$(INFO_COLOR)$(NAME) $(NO_COLOR)successfully compiled. $(OK_COLOR)✓$(NO_COLOR)\n"

$(OBJECTS_FOLDER)%.o: $(SOURCES_FOLDER)%.c
	@$(CC) $(FLAGS) -I$(INCLUDES_FOLDER) -c $< -o $@
	@printf "$(NO_COLOR)Creating $(INFO_COLOR)%-30s $(OK_COLOR)✓$(NO_COLOR)\r" "$@"

libft:
	@printf "\n$(NO_COLOR)-------- $(INFO_COLOR)Libft $(NO_COLOR)--------\n"
	@make -C libft
	@printf "$(NO_COLOR)-----------------------\n\n"

libfclean:
	@printf "\n$(NO_COLOR)-------- $(INFO_COLOR)Libft $(NO_COLOR)--------\n"
	@make -C libft fclean
	@printf "$(NO_COLOR)-----------------------\n\n"

clean:
	@rm -f $(OBJECTS)
	@printf "$(INFO_COLOR)$(PROJECT_NAME) $(NO_COLOR)Removed all objects$(NO_COLOR).\n"

fclean: clean
	@rm -f $(NAME)
	@printf "$(INFO_COLOR)$(PROJECT_NAME) $(NO_COLOR)Removed $(INFO_COLOR)$(NAME)$(NO_COLOR).\n"

aclean: libfclean fclean
	@rm -rf $(DIRS) $(MAIN) gnl.dSYM
	@printf "$(INFO_COLOR)$(PROJECT_NAME) $(NO_COLOR)Removed $(INFO_COLOR)all files$(NO_COLOR).\n"
	@rm Makefile

ulclean:
	@rm -f $(ULIMIT_FOLDER)/*
	@printf "$(INFO_COLOR)$(PROJECT_NAME) $(NO_COLOR)Removed $(INFO_COLOR)all ulimit files$(NO_COLOR).\n"

re: fclean all
