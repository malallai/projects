/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strsplit.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/21 16:59:15 by malallai          #+#    #+#             */
/*   Updated: 2019/01/21 17:48:34 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

static size_t	count_words(const char *str, char splitter)
{
	int		count;
	char	*tmp;
	int		index;

	count = 0;
	tmp = ft_strdup(str);
	while (tmp[index])
	{
		if (tmp[index] == splitter)
			index++;
		else
		{
			count++;
			while (tmp[index] && tmp[index] != splitter)
				index++;
		}
	}
	free(tmp);
	return (count);
}

static char		**free_tab(char **array, size_t size)
{
	int index;

	index = 0;
	while (index != size)
		free(array[index++]);
	free(array);
	return (NULL);
}

static char		*copy(char *str, char splitter)
{
	char	*tmp;
	int		i;
	int		size;

	size = 0;
	while (str[size] != splitter)
		size++;
	tmp = ft_strnew(size);
	i = 0;
	while (i < size)
	{
		tmp[i] = str[i];
		i++;
	}
	tmp[i] = '\0';
	ft_putendl(tmp);
	return (tmp);
}

char			**ft_strsplit(char const *str, char splitter)
{
	char	**array;
	char	*tmp_str;
	int		index;
	size_t	words;
	char	*tmp;

	words = count_words(str, splitter);
	if (!(array = malloc(sizeof(char *) * words)))
		return (NULL);
	tmp_str = ft_strdup(str);
	index = 0;
	while (index < words)
	{
		if (!(array[index] = copy(tmp_str, splitter)))
			return (free_tab(array, words));
		tmp = tmp_str;
		tmp_str = ft_trimchar(tmp, splitter);
		free(tmp);
		index++;
	}
	free(tmp_str);
	array[index] = NULL;
	index = 0;
	while (index < words)
	{
		ft_putstr("Word : ");
		ft_putendl(array[index++]);
	}
	return (array);
}

int	main(int argc, char **argv)
{
	char	**array;

	if (argc > 1)
		array = ft_strsplit(argv[1], *argv[2]);
	int i = 0;
	ft_putendl("test");
	while (array[i])
	{
		ft_putstr("Word : ");
		ft_putendl(array[i++]);
	}
	return (0);
}
